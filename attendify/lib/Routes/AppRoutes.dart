import 'package:attendify/Pages/Home.dart';
import 'package:flutter/material.dart';

class AppRoutes {
  static const home = '/';

  static Map<String, WidgetBuilder> getRoutes(){
    return{
      home: (context) => HomePage()
    };
  }
}