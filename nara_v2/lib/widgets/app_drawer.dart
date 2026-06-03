import 'package:flutter/material.dart';

class AppDrawer extends StatelessWidget {
  const AppDrawer({super.key});

  Widget menuItem(
    IconData icon,
    String title,
    bool active,
    VoidCallback onTap,
  ) {
    return Padding(
      padding: const EdgeInsets.symmetric(
        horizontal: 15,
        vertical: 5,
      ),
      child: ListTile(
        tileColor:
            active ? const Color(0xff0D6172) : Colors.transparent,
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(12),
        ),
        leading: Icon(
          icon,
          color:
              active ? Colors.white : const Color(0xff0D6172),
        ),
        title: Text(
          title,
          style: TextStyle(
            color:
                active ? Colors.white : const Color(0xff0D6172),
            fontWeight: FontWeight.w600,
          ),
        ),
        onTap: onTap,
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Drawer(
      child: Column(
        children: [
          Container(
            width: double.infinity,
            padding: const EdgeInsets.all(20),
            color: Colors.white,
            child: const Text(
              "Menu",
              style: TextStyle(
                fontSize: 28,
                fontWeight: FontWeight.bold,
                color: Color(0xff0D6172),
              ),
            ),
          ),

          const SizedBox(height: 10),

          menuItem(Icons.home, "Dashboard", true, () {}),
          menuItem(Icons.edit_note, "Kelola Nilai", false, () {}),
          menuItem(Icons.description, "Raport", false, () {}),
          menuItem(Icons.settings, "Setting", false, () {}),
        ],
      ),
    );
  }
}