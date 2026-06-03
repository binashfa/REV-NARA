import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

import '../widgets/app_drawer.dart';
import '../widgets/custom_header.dart';
import '../widgets/stat_card.dart';
import '../widgets/nilai_terbaru_card.dart';
import 'login_page.dart';

class DashboardPage extends StatefulWidget {
  const DashboardPage({super.key});

  @override
  State<DashboardPage> createState() => _DashboardPageState();
}

class _DashboardPageState extends State<DashboardPage> {
  bool isLoading = true;

  Map<String, dynamic> data = {};

  Future<void> getDashboard() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();

    String token = prefs.getString('token') ?? '';

    try {
      final response = await http.get(
        Uri.parse('http://192.168.1.73:8000/api/guru/dashboard'),
        headers: {
          'Authorization': 'Bearer $token',
          'Accept': 'application/json',
        },
      );

      print("STATUS : ${response.statusCode}");

      print("BODY : ${response.body}");

      if (response.statusCode == 200) {
        final result = jsonDecode(response.body);

        setState(() {
          data = result['data'] ?? {};

          isLoading = false;
        });
      } else {
        setState(() {
          isLoading = false;
        });
      }
    } catch (e) {
      print(e);

      setState(() {
        isLoading = false;
      });
    }
  }

  Future<void> logout() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();

    await prefs.clear();

    if (!mounted) return;

    Navigator.pushAndRemoveUntil(
      context,
      MaterialPageRoute(builder: (_) => const LoginPage()),
      (route) => false,
    );
  }

  @override
  void initState() {
    super.initState();
    getDashboard();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      drawer: const AppDrawer(),

      backgroundColor: const Color(0xffF5F7F5),

      body: isLoading
          ? const Center(child: CircularProgressIndicator())
          : SafeArea(
              child: SingleChildScrollView(
                padding: const EdgeInsets.all(16),
                child: Column(
                  children: [
                    CustomHeader(
                      namaGuru: data['guru']?['nama'] ?? '',
                      onLogout: logout,
                    ),

                    const SizedBox(height: 20),

                    // WELCOME CARD
                    Container(
                      width: double.infinity,
                      padding: const EdgeInsets.all(28),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(30),
                        gradient: const LinearGradient(
                          colors: [Color(0xffE8ECD0), Color(0xffD6E0BF)],
                        ),
                      ),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Container(
                            padding: const EdgeInsets.symmetric(
                              horizontal: 14,
                              vertical: 8,
                            ),
                            decoration: BoxDecoration(
                              color: Colors.white,
                              borderRadius: BorderRadius.circular(30),
                            ),
                            child: const Row(
                              mainAxisSize: MainAxisSize.min,
                              children: [
                                Icon(
                                  Icons.dashboard,
                                  size: 16,
                                  color: Color(0xff6F8A4B),
                                ),

                                SizedBox(width: 6),

                                Text(
                                  "DASHBOARD",
                                  style: TextStyle(
                                    fontSize: 12,
                                    color: Color(0xff0D6172),
                                    fontWeight: FontWeight.bold,
                                  ),
                                ),
                              ],
                            ),
                          ),

                          const SizedBox(height: 25),

                          const Text(
                            "Dashboard Guru",
                            style: TextStyle(
                              fontSize: 34,
                              fontWeight: FontWeight.bold,
                              color: Color(0xff0D6172),
                            ),
                          ),

                          const SizedBox(height: 10),

                          Text(
                            "Selamat datang kembali, ${data['guru']?['nama'] ?? '-'}",
                            style: const TextStyle(
                              fontSize: 16,
                              color: Color(0xff3E6B76),
                            ),
                          ),
                        ],
                      ),
                    ),

                    const SizedBox(height: 25),

                    StatCard(
                      title: "Total Siswa",
                      value: data['jumlah_siswa']?.toString() ?? '0',
                      color: const Color(0xff92A85D),
                      icon: Icons.groups,
                    ),

                    const SizedBox(height: 15),

                    StatCard(
                      title: "Total Nilai",
                      value: data['jumlah_nilai']?.toString() ?? '0',
                      color: const Color(0xffD89A8D),
                      icon: Icons.bar_chart,
                    ),

                    const SizedBox(height: 25),

                    NilaiTerbaruCard(nilai: data['nilai_terbaru'] ?? []),
                  ],
                ),
              ),
            ),
    );
  }
}
