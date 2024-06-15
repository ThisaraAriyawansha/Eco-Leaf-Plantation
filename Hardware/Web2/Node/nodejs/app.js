const express = require('express');
const SerialPort = require('serialport-windows-fix');  // Use serialport-windows-fix instead of the original serialport
const Readline = require('@serialport/parser-readline');

const app = express();

// Use the full path for COM4
const port = new SerialPort('\\\\.\\COM4', { baudRate: 9600 });
const parser = port.pipe(new Readline({ delimiter: '\n' }));

app.use(express.json());

// Open errors will be emitted as an error event
port.on('error', function(err) {
  console.error('Error on serial port: ', err.message);
});

// Switch on the LED
app.post('/switchOn', (req, res) => {
  port.write('1', function(err) {
    if (err) {
      console.error('Error on write: ', err.message);
      return res.status(500).json({ error: 'Error on write: ' + err.message });
    }
    console.log('LED switched ON');
    res.status(200).json({ message: 'LED switched ON' });
  });
});

// Switch off the LED
app.post('/switchOff', (req, res) => {
  port.write('0', function(err) {
    if (err) {
      console.error('Error on write: ', err.message);
      return res.status(500).json({ error: 'Error on write: ' + err.message });
    }
    console.log('LED switched OFF');
    res.status(200).json({ message: 'LED switched OFF' });
  });
});

const server = app.listen(3000, () => {
  console.log('Server is running on port 3000');
});
