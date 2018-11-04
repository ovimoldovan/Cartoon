/**
 * Created by ovi on 24/03/2018.
 */
import com.google.zxing.BarcodeFormat;
import com.google.zxing.WriterException;
import com.google.zxing.client.j2se.MatrixToImageWriter;
import com.google.zxing.common.BitMatrix;
import com.google.zxing.qrcode.QRCodeWriter;

import javax.swing.*;
import java.awt.*;
import java.io.*;
import java.nio.charset.StandardCharsets;
import java.nio.file.FileSystems;
import java.nio.file.Files;
import java.nio.file.Path;
import java.util.Random;


import cc.arduino.Arduino;

import javax.swing.*;

import com.fazecast.jSerialComm.SerialPort;
import gnu.io.CommPort;




//import  com.fazecast.jSerialComm.SerialPort.*;

import java.io.IOException;
import java.util.Scanner;




public class QRCodeGenerator {
    private static final String QR_CODE_IMAGE_PATH = "./MyQRCode.png";

    private static void generateQRCodeImage(String text, int width, int height, String filePath)
            throws WriterException, IOException {
        QRCodeWriter qrCodeWriter = new QRCodeWriter();
        BitMatrix bitMatrix = qrCodeWriter.encode(text, BarcodeFormat.QR_CODE, width, height);

        Path path = FileSystems.getDefault().getPath(filePath);
        MatrixToImageWriter.writeToPath(bitMatrix, "PNG", path);
    }

    public static class ShowPNG extends JFrame{
        private ShowPNG(String arg){
            if(arg== null){
                arg = "MyQRCode.png";
            }
            JPanel panel = new JPanel();
            this.setSize(500,640);
            //panel.setBackground(Color.CYAN);
            JLabel label = new JLabel();

            ImageIcon icon = new ImageIcon(arg);
            label.setIcon(icon);
            panel.add(label);
            this.getContentPane().add(panel);
        }
    }

    public static void main(String[] args) throws Exception {

        SerialPort port = SerialPort.getCommPorts()[0];
        System.out.println(port.getSystemPortName());
        port.openPort();

        port.openPort();

        if(port.isOpen())
        {
            System.out.println("Is opened");
        }

        while(port.bytesAvailable() == 0) {}

        System.out.println(port.getInputStream().read());
        /*System.out.println(port.getInputStream().read());



        System.out.println(port.getInputStream().read());*/


        // GENERATE QR

        int numarCod = 2018;
        Random rand = new Random();
        int numarCod2 = rand.nextInt(1000);
        System.out.println(numarCod2);

        String numarCod3 = String.valueOf(numarCod2);


        String FILENAME = "fisierCod.txt";
        BufferedWriter out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(FILENAME), StandardCharsets.UTF_8));
        out.write(numarCod3);
        out.close();

        try {
            generateQRCodeImage("http://172.20.10.5/Marean/code2.php?code="+numarCod2, 350, 350, QR_CODE_IMAGE_PATH);
        } catch (WriterException e) {
            System.out.println("Could not generate QR Code, WriterException :: " + e.getMessage());
        } catch (IOException e) {
            System.out.println("Could not generate QR Code, IOException :: " + e.getMessage());
        }



        //POZA

        new ShowPNG(args.length == 0 ? null : args[0]).setVisible(true);

        // PRINT

        UsePrintingServiceInJava.print();

    }

    private byte[] getQRCodeImage(String text, int width, int height) throws WriterException, IOException {
        QRCodeWriter qrCodeWriter = new QRCodeWriter();
        BitMatrix bitMatrix = qrCodeWriter.encode(text, BarcodeFormat.QR_CODE, width, height);

        ByteArrayOutputStream pngOutputStream = new ByteArrayOutputStream();
        MatrixToImageWriter.writeToStream(bitMatrix, "PNG", pngOutputStream);
        byte[] pngData = pngOutputStream.toByteArray();
        return pngData;
    }
}