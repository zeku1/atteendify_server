import 'package:attendify/Components/GenerateQr.dart';
import 'package:attendify/Components/ScannerComponent.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:shared_preferences/shared_preferences.dart';

class ScannerPage extends StatefulWidget {
  @override
  State<ScannerPage> createState() => _ScannerPageState();
}

class _ScannerPageState extends State<ScannerPage> {
  SharedPreferences? _prefs;

  @override
  void initState() {
    super.initState();
    _initializeSharedPreferences();
  }

  void _initializeSharedPreferences() async {
    _prefs = await SharedPreferences.getInstance(); // Initialize once
  }

  String? _getRole() {
    return _prefs?.getString('role');
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color(0xFFFFFFFF),
      body: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 20.0, vertical: 30.0),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.start,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(
                  'ATTENDIFY',
                  style: GoogleFonts.hankenGrotesk(
                    fontWeight: FontWeight.w900,
                    fontSize: 15,
                    color: Color(0x80000000), // 50% opacity black
                    height: 19.54 / 15,
                  ),
                ),
                TextButton(
                  onPressed: () {
                    // Handle sign-in action
                  },
                  child: Text(
                    _getRole() ?? 'Unknown Role',
                    style: GoogleFonts.hankenGrotesk(
                      fontWeight: FontWeight.w400,
                      fontSize: 15,
                      color: Color(0x91000000), // 57% opacity black
                      height: 19.54 / 15,
                    ),
                  ),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }
}