import 'dart:typed_data';

import 'package:flutter/material.dart';
import 'package:mobile_scanner/mobile_scanner.dart';

class ScannerComponent extends StatelessWidget {
  bool _isProcessing = false;

  @override
  Widget build(BuildContext context) {
    return _scannerComponent();
  }

  _scannerComponent(){
    return Container(
      child: Builder(
        builder: (context) {
          return MobileScanner(
            controller: MobileScannerController(
              detectionSpeed: DetectionSpeed.noDuplicates,
              returnImage: true,
            ),
            onDetect: (capture) async {
              if(_isProcessing) return;

              _isProcessing = true;

              final List<Barcode> barcodes = capture.barcodes;
              final Uint8List? image = capture.image;

              for (final barcode in barcodes) {
                print('Barcode found: ${barcode.rawValue}');
              }

              if (image != null && barcodes.isNotEmpty) {
                showDialog(
                  context: context,
                  builder: (context) {
                    return AlertDialog(
                      title: Text(barcodes.first.rawValue ?? "No Barcode Data"),
                      content: Image(image: MemoryImage(image)),
                    );
                  },
                );
              }

              // Throttle by delaying the next detection.
              await Future.delayed(Duration(seconds: 2)); // Adjust the duration as needed.

              // Reset the flag after delay.
              _isProcessing = false;
            },
          );
        },
      ),
    );

  }
}