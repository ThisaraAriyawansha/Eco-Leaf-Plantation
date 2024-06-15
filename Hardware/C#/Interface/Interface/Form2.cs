using System;
using System.Windows.Forms;
using System.IO.Ports;


namespace Interface
{
    public partial class Form2 : Form
    {
        // Create a SerialPort object
        private SerialPort serialPort;

        public Form2()
        {
            InitializeComponent();

            // Initialize the SerialPort
            serialPort = new SerialPort();
            serialPort.PortName = "COM4"; // Change this to the correct COM port
            serialPort.BaudRate = 9600;   // Make sure it matches the Arduino sketch
            serialPort.Open();            // Open the serial port
        }

        private void button1_Click(object sender, EventArgs e)
        {
            // Button1 click event to turn on the LED
            SendCommand("1");
        }

        private void button2_Click_1(object sender, EventArgs e)
        {
            // Button2 click event to turn off the LED
            SendCommand("0");
        }

        private void SendCommand(string command)
        {
            // Send a command to the Arduino
            if (serialPort.IsOpen)
            {
                serialPort.Write(command);
            }
            else
            {
                MessageBox.Show("Serial port is not open.");
            }
        }

        // Remember to close the serial port when closing the form
        private void Form2_FormClosing(object sender, FormClosingEventArgs e)
        {
            if (serialPort.IsOpen)
            {
                serialPort.Close();
            }
        }

        
    }
}
