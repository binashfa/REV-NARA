import 'dart:convert';
import 'package:http/http.dart' as http;

class AuthService {

  Future<Map<String, dynamic>> login(
      String username,
      String password
  ) async {

    final response = await http.post(
      Uri.parse(
        'http://10.21.76.222:8000/api/login',
      ),
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
      },
      body: jsonEncode({
        'username': username,
        'password': password,
      }),
    );

    return jsonDecode(response.body);
  }
}