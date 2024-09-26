import 'package:flutter/material.dart';

class HomePage extends StatelessWidget {
  
  @override
  Widget build(BuildContext context) {
    return _homePage();
  }
  
  Container _homePage(){
    return Container(
      child: Text(
          'hello',
        style: TextStyle(
          color: Colors.white
        ),
      ),
    );
  }
  
}