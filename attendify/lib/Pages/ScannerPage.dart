import 'package:attendify/Components/GenerateQr.dart';
import 'package:attendify/Components/ScannerComponent.dart';
import 'package:flutter/material.dart';

class ScannerPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Scanner Page'),
      ),
      body: Container(
        child: ScannerComponent(),
        )
      );
  }

}