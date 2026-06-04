import 'dart:convert';

import '../../pages/dashboard_page.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class LoginPage extends StatefulWidget {
  const LoginPage({super.key});

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final usernameController = TextEditingController();
  final passwordController = TextEditingController();

  bool isHidden = true;
  bool isLoading = false;

  Future<void> login() async {
    if (usernameController.text.isEmpty ||
        passwordController.text.isEmpty) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text("Username dan Password wajib diisi"),
        ),
      );
      return;
    }

    setState(() {
      isLoading = true;
    });

    try {
      final response = await http.post(
        Uri.parse(
          'http://10.21.76.222:8000/api/login',
        ),
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: jsonEncode({
          'username': usernameController.text,
          'password': passwordController.text,
        }),
      );

      print(response.statusCode);
      print(response.body);

      final data = jsonDecode(response.body);

      if (response.statusCode == 200 &&
          data['success'] == true) {

        SharedPreferences prefs =
            await SharedPreferences.getInstance();

        await prefs.setString(
          'token',
          data['token'],
        );

        await prefs.setString(
          'username',
          data['user']['username'],
        );

        await prefs.setString(
          'role',
          data['user']['role'],
        );

        if (!mounted) return;

        // pindah halaman dashboard
        Navigator.pushReplacement(
          context,
          MaterialPageRoute(
            builder: (_) => const DashboardPage(),
          ),
        );

      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(
              data['message'] ??
                  "Login gagal",
            ),
          ),
        );
      }
    } catch (e) {
      print(e);

      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text(
            "Error: $e",
          ),
        ),
      );
    }

    setState(() {
      isLoading = false;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF6E8E67),
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.all(14),
          child: Container(
            decoration: BoxDecoration(
              color: const Color(0xFF5F8A69),
              borderRadius: BorderRadius.circular(10),
            ),
            child: Column(
              children: [
                Expanded(
                  flex: 4,
                  child: Container(
                    margin: const EdgeInsets.all(18),
                    decoration: BoxDecoration(
                      color: const Color(0xFFF0EACC),
                      borderRadius:
                          BorderRadius.circular(30),
                    ),
                    child: Center(
                      child: Image.asset(
                        'assets/images/login.png',
                        height: 180,
                      ),
                    ),
                  ),
                ),

                Expanded(
                  flex: 6,
                  child: Container(
                    width: double.infinity,
                    padding:
                        const EdgeInsets.symmetric(
                      horizontal: 28,
                      vertical: 20,
                    ),
                    decoration: const BoxDecoration(
                      color: Color(0xFF0D6172),
                      borderRadius:
                          BorderRadius.only(
                        topLeft:
                            Radius.circular(40),
                        topRight:
                            Radius.circular(40),
                        bottomLeft:
                            Radius.circular(30),
                        bottomRight:
                            Radius.circular(30),
                      ),
                    ),
                    child: SingleChildScrollView(
                      child: Column(
                        children: [
                          Container(
                            width: 60,
                            height: 6,
                            decoration:
                                BoxDecoration(
                              color:
                                  Colors.white24,
                              borderRadius:
                                  BorderRadius
                                      .circular(
                                          10),
                            ),
                          ),

                          const SizedBox(
                              height: 25),

                          const Text(
                            "Login",
                            style: TextStyle(
                              fontSize: 22,
                              fontWeight:
                                  FontWeight.bold,
                              color:
                                  Color(0xFFF4EFCF),
                            ),
                          ),

                          const SizedBox(
                              height: 25),

                          const Align(
                            alignment:
                                Alignment
                                    .centerLeft,
                            child: Text(
                              "Username",
                              style: TextStyle(
                                color:
                                    Color(
                                        0xFFF4EFCF),
                                fontWeight:
                                    FontWeight
                                        .w600,
                              ),
                            ),
                          ),

                          const SizedBox(
                              height: 8),

                          TextField(
                            controller:
                                usernameController,
                            decoration:
                                InputDecoration(
                              filled: true,
                              fillColor:
                                  const Color(
                                      0xFFDDE2EC),
                              border:
                                  OutlineInputBorder(
                                borderRadius:
                                    BorderRadius
                                        .circular(
                                            30),
                                borderSide:
                                    BorderSide
                                        .none,
                              ),
                            ),
                          ),

                          const SizedBox(
                              height: 20),

                          const Align(
                            alignment:
                                Alignment
                                    .centerLeft,
                            child: Text(
                              "Password",
                              style: TextStyle(
                                color:
                                    Color(
                                        0xFFF4EFCF),
                                fontWeight:
                                    FontWeight
                                        .w600,
                              ),
                            ),
                          ),

                          const SizedBox(
                              height: 8),

                          TextField(
                            controller:
                                passwordController,
                            obscureText:
                                isHidden,
                            decoration:
                                InputDecoration(
                              filled: true,
                              fillColor:
                                  const Color(
                                      0xFFDDE2EC),
                              border:
                                  OutlineInputBorder(
                                borderRadius:
                                    BorderRadius
                                        .circular(
                                            30),
                                borderSide:
                                    BorderSide
                                        .none,
                              ),
                              suffixIcon:
                                  IconButton(
                                icon: Icon(
                                  isHidden
                                      ? Icons
                                          .visibility_off
                                      : Icons
                                          .visibility,
                                  color:
                                      Colors
                                          .brown,
                                ),
                                onPressed:
                                    () {
                                  setState(
                                      () {
                                    isHidden =
                                        !isHidden;
                                  });
                                },
                              ),
                            ),
                          ),

                          const SizedBox(
                              height: 10),

                          Align(
                            alignment:
                                Alignment
                                    .centerRight,
                            child: TextButton(
                              onPressed:
                                  () {},
                              child:
                                  const Text(
                                "Forgot Password?",
                                style:
                                    TextStyle(
                                  color:
                                      Colors
                                          .white70,
                                  decoration:
                                      TextDecoration
                                          .underline,
                                ),
                              ),
                            ),
                          ),

                          const SizedBox(
                              height: 15),

                          SizedBox(
                            width:
                                double.infinity,
                            height: 55,
                            child:
                                ElevatedButton(
                              onPressed:
                                  isLoading
                                      ? null
                                      : login,
                              style:
                                  ElevatedButton
                                      .styleFrom(
                                backgroundColor:
                                    const Color(
                                        0xFFD39A90),
                                shape:
                                    RoundedRectangleBorder(
                                  borderRadius:
                                      BorderRadius
                                          .circular(
                                              30),
                                ),
                              ),
                              child: isLoading
                                  ? const CircularProgressIndicator(
                                      color: Colors
                                          .white,
                                    )
                                  : const Text(
                                      "Masuk",
                                      style:
                                          TextStyle(
                                        color: Colors
                                            .white,
                                        fontSize:
                                            18,
                                        fontWeight:
                                            FontWeight
                                                .bold,
                                      ),
                                    ),
                            ),
                          )
                        ],
                      ),
                    ),
                  ),
                )
              ],
            ),
          ),
        ),
      ),
    );
  }
}