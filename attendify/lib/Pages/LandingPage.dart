import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class LandingPage extends StatefulWidget {
  @override
  _LandingPageState createState() => _LandingPageState();
}

class _LandingPageState extends State<LandingPage> {
  final TextEditingController _emailController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();
  bool _isEmailFieldFocused = false;
  bool _isPasswordFieldFocused = false;

  @override
  void dispose() {
    _emailController.dispose();
    _passwordController.dispose();
    super.dispose();
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
            // ATTENDIFY and SIGN IN at the top
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
                    'SIGN IN',
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
            // Spacing between top and center content
            Container(margin: EdgeInsets.only(bottom: 280)),

            Center(
              child: Column(
                children: [
                  // Stack for the email field
                  Stack(
                    alignment: Alignment.center,
                    children: [
                      // Show hint when the field is not focused and empty
                      if (!_isEmailFieldFocused && _emailController.text.isEmpty)
                        RichText(
                          text: TextSpan(
                            children: [
                              TextSpan(
                                text: 'Write ',
                                style: GoogleFonts.hankenGrotesk(
                                  fontWeight: FontWeight.w300,
                                  fontSize: 25,
                                  color: Colors.black.withOpacity(0.5),
                                ),
                              ),
                              TextSpan(
                                text: 'email',
                                style: GoogleFonts.hankenGrotesk(
                                  fontWeight: FontWeight.w300,
                                  fontSize: 25,
                                  color: Colors.black,
                                ),
                              ),
                              TextSpan(
                                text: ' here',
                                style: GoogleFonts.hankenGrotesk(
                                  fontWeight: FontWeight.w300,
                                  fontSize: 25,
                                  color: Colors.black.withOpacity(0.5),
                                ),
                              ),
                            ],
                          ),
                        ),
                      // Email input
                      Focus(
                        onFocusChange: (hasFocus) {
                          setState(() {
                            _isEmailFieldFocused = hasFocus;
                          });
                        },
                        child: TextField(
                          controller: _emailController,
                          textAlign: TextAlign.center,
                          style: GoogleFonts.hankenGrotesk(
                            fontWeight: FontWeight.w400,
                            fontSize: 25,
                            color: Colors.black,
                          ),
                          decoration: InputDecoration(
                            border: InputBorder.none,
                            hintText: '', // Removing the default hintText
                          ),
                        ),
                      ),
                    ],
                  ),

                  // Space between email and password
                  Container(margin: EdgeInsets.only(bottom: 1)),

                  // Stack for the password field
                  Stack(
                    alignment: Alignment.center,
                    children: [
                      // Show hint when the field is not focused and empty
                      if (!_isPasswordFieldFocused && _passwordController.text.isEmpty)
                        RichText(
                          text: TextSpan(
                            children: [
                              TextSpan(
                                text: 'Write ',
                                style: GoogleFonts.hankenGrotesk(
                                  fontWeight: FontWeight.w300,
                                  fontSize: 25,
                                  color: Colors.black.withOpacity(0.5),
                                ),
                              ),
                              TextSpan(
                                text: 'password',
                                style: GoogleFonts.hankenGrotesk(
                                  fontWeight: FontWeight.w300,
                                  fontSize: 25,
                                  color: Colors.black,
                                ),
                              ),
                              TextSpan(
                                text: ' here',
                                style: GoogleFonts.hankenGrotesk(
                                  fontWeight: FontWeight.w300,
                                  fontSize: 25,
                                  color: Colors.black.withOpacity(0.5),
                                ),
                              ),
                            ],
                          ),
                        ),
                      // Password input
                      Focus(
                        onFocusChange: (hasFocus) {
                          setState(() {
                            _isPasswordFieldFocused = hasFocus;
                          });
                        },
                        child: TextField(
                          controller: _passwordController,
                          textAlign: TextAlign.center,
                          obscureText: true,
                          style: GoogleFonts.hankenGrotesk(
                            fontWeight: FontWeight.w400,
                            fontSize: 25,
                            color: Colors.black,
                          ),
                          decoration: InputDecoration(
                            border: InputBorder.none,
                            hintText: '', // Removing the default hintText
                          ),
                        ),
                      ),
                    ],
                  ),

                  // Space between password and Forgot Password
                  Container(margin: EdgeInsets.only(bottom: 20)),

                  GestureDetector(
                    onTap: () {
                      // Handle forgot password action
                    },
                    child: Text(
                      'Forgot password?',
                      style: GoogleFonts.hankenGrotesk(
                        fontWeight: FontWeight.w400,
                        fontSize: 12,
                        color: Color(0xff000000).withOpacity(0.5),
                        height: 15.64 / 12,
                      ),
                    ),
                  ),

                  // Space between Forgot Password and JUMP IN
                  Container(margin: EdgeInsets.only(bottom: 60)),

                  GestureDetector(
                    onTap: () {
                      // Handle JUMP IN action
                    },
                    child: Text(
                      'JUMP IN',
                      style: GoogleFonts.hankenGrotesk(
                        fontWeight: FontWeight.w900,
                        fontSize: 25,
                        color: Color(0xff000000),
                        height: 32.57 / 25,
                      ),
                    ),
                  ),

                  // Space between JUMP IN and bottom text
                  Container(margin: EdgeInsets.only(bottom: 175)),

                  GestureDetector(
                    onTap: () {
                      // Handle "Don't have an account yet?" action
                    },
                    child: Text(
                      'Don\'t have an account yet?',
                      style: GoogleFonts.hankenGrotesk(
                        fontWeight: FontWeight.w400,
                        fontSize: 12,
                        color: Color(0xff000000).withOpacity(0.5),
                        height: 15.64 / 12,
                      ),
                    ),
                  ),
                ],
              ),
            ),
            Spacer(flex: 2), // Bottom space
          ],
        ),
      ),
    );
  }
}
