import 'package:attendify/Pages/Home.dart';
import 'package:attendify/Pages/ScannerPage.dart';
import 'package:flutter/material.dart';

import '../Pages/LandingPage.dart';
import '../Pages/Registration.dart';

class AppRoutes {
  static const home = '/';
  static const landing = '/landing';
  static const registration = '/registration';
  static const scanner = '/scanner';

  static Map<String, WidgetBuilder> getRoutes(){
    return{
      home: (context) => HomePage(),
      landing: (context) => LandingPage(),
      registration: (context) => Registration(),
      scanner: (context) => ScannerPage(),
    };
  }
}
