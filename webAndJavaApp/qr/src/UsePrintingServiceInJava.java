/**
 * Created by ovi on 24/03/2018.
 */


import java.io.BufferedInputStream;
import java.io.FileInputStream;
import java.io.InputStream;

import javax.print.Doc;
import javax.print.DocFlavor;
import javax.print.DocPrintJob;
import javax.print.PrintService;
import javax.print.PrintServiceLookup;
import javax.print.SimpleDoc;
import javax.print.event.PrintJobAdapter;
import javax.print.event.PrintJobEvent;

public class UsePrintingServiceInJava {

    private static boolean jobRunning = true;

    public static void print() throws Exception {

        // Open the image file

        InputStream is =

                new BufferedInputStream(new FileInputStream("./MyQRCode.png"));

        // create a PDF doc flavor

        DocFlavor flavor = DocFlavor.INPUT_STREAM.PNG;

        // Locate the default print service for this environment.

        PrintService service = PrintServiceLookup.lookupDefaultPrintService();

        // Create and return a PrintJob capable of handling data from

        // any of the supported document flavors.

        DocPrintJob printJob = service.createPrintJob();

        // register a listener to get notified when the job is complete

        printJob.addPrintJobListener(new JobCompleteMonitor());

        // Construct a SimpleDoc with the specified

        // print data, doc flavor and doc attribute set.

        Doc doc = new SimpleDoc(is, flavor, null);

        // Print a document with the specified job attributes.

        printJob.print(doc, null);

        while (jobRunning) {

            Thread.sleep(1000);

        }

        System.out.println("Exiting app");

        is.close();

    }

    private static class JobCompleteMonitor extends PrintJobAdapter {

        public void printJobCompleted(PrintJobEvent jobEvent) {
            System.out.println("Job completed");
            jobRunning = false;
        }
    }

}