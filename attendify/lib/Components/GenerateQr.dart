import 'dart:typed_data';
import 'package:pretty_qr_code/pretty_qr_code.dart';
import 'package:flutter/material.dart';


class GenerateQrComponent extends StatefulWidget {
  @override
  State<GenerateQrComponent> createState() => _GenerateQrComponentState();
}

class _GenerateQrComponentState extends State<GenerateQrComponent> {
  String? qrData;

  @override
  Widget build(BuildContext context) {
    return _scannerComponent();
  }

  _scannerComponent(){
    return Container(
      padding: EdgeInsets.all(10.0),
      child: Column(
        mainAxisSize: MainAxisSize.max,
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          TextField(
            onSubmitted: (value) {
                setState((){
                  qrData = value;
                });
            },
          ),
          if (qrData != null) PrettyQrView.data(data: qrData!),
        ],
      )
    );

  }
}