import 'package:flutter/material.dart';

class CustomHeader extends StatelessWidget {
  final String namaGuru;
  final VoidCallback onLogout;

  const CustomHeader({
    super.key,
    required this.namaGuru,
    required this.onLogout,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(
        horizontal: 16,
        vertical: 14,
      ),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(20),
        boxShadow: const [
          BoxShadow(
            color: Colors.black12,
            blurRadius: 5,
          )
        ],
      ),
      child: Row(
        children: [
          Builder(
            builder: (context) => IconButton(
              icon: const Icon(
                Icons.menu,
                size: 32,
                color: Color(0xff0D6172),
              ),
              onPressed: () {
                Scaffold.of(context).openDrawer();
              },
            ),
          ),

          const SizedBox(width: 8),

          Image.asset(
            'assets/images/logoNara.png',
            height: 55,
          ),

          const Spacer(),

          Container(
            padding: const EdgeInsets.symmetric(
              horizontal: 10,
              vertical: 8,
            ),
            decoration: BoxDecoration(
              color: const Color(0xffEDF2F1),
              borderRadius: BorderRadius.circular(40),
            ),
            child: Row(
              children: [
                CircleAvatar(
                  radius: 22,
                  backgroundColor:
                      const Color(0xff0D6172),
                  child: Text(
                    namaGuru.isEmpty
                        ? "P"
                        : namaGuru
                            .substring(0, 1)
                            .toUpperCase(),
                    style: const TextStyle(
                      color: Colors.white,
                      fontWeight:
                          FontWeight.bold,
                    ),
                  ),
                ),

                const SizedBox(width: 8),

                IconButton(
                  icon: const Icon(
                    Icons.logout,
                    color: Color(0xffFF6B6B),
                  ),
                  onPressed: onLogout,
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}