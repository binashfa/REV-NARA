import 'package:flutter/material.dart';

class StatCard extends StatelessWidget {
  final String title;
  final String value;
  final Color color;
  final IconData icon;

  const StatCard({
    super.key,
    required this.title,
    required this.value,
    required this.color,
    required this.icon,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      height: 130,
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius:
            BorderRadius.circular(30),
      ),
      child: Row(
        children: [
          Expanded(
            child: Padding(
              padding:
                  const EdgeInsets.all(25),
              child: Column(
                mainAxisAlignment:
                    MainAxisAlignment.center,
                crossAxisAlignment:
                    CrossAxisAlignment.start,
                children: [
                  Text(title),

                  const SizedBox(height: 8),

                  Text(
                    value,
                    style:
                        const TextStyle(
                      fontSize: 36,
                      fontWeight:
                          FontWeight.bold,
                    ),
                  ),
                ],
              ),
            ),
          ),

          Container(
            width: 100,
            decoration: BoxDecoration(
              color: color,
              borderRadius:
                  BorderRadius.circular(
                      30),
            ),
            child: Icon(
              icon,
              size: 45,
              color: Colors.white,
            ),
          )
        ],
      ),
    );
  }
}