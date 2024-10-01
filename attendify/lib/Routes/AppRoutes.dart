import 'package:attendify/Pages/LandingPage.dart';
import 'package:attendify/Pages/Registration.dart';
import 'package:flutter/material.dart';

class AppRoutes {
  static const home = '/';
  static const landing = '/landing';
  static const registration = '/registration'; // Fixed spelling

  static Map<String, WidgetBuilder> getRoutes() {
    return {
      home: (context) => LandingPage(),  // Set the LandingPage as the home page
      landing: (context) => LandingPage(),
      registration: (context) => Registration(), // Fixed spelling
    };
  }
}
