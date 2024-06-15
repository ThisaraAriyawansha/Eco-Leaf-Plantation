const express = require('express');
const SerialPort = require('serialport');
const Readline = require('@serialport/parser-readline');

const app = express();
const port = 3000; // Replace with the desired port number

const arduinoPort = new SerialPort('COM4', { baudRate: 9600 }); // Replace COM4 with your Arduino's serial port
const parser = arduinoPort.pipe(new Readline({ delimiter: '\n' }));

app.use(express.static('public'));

app.get('/toggleLED/:state', (req, res) => {
  const { state } = req.params;
  arduinoPort.write(state === 'on' ? '1' : '0');
  res.send(`LED ${state}`);
});

parser.on('data', (data) => {
  console.log(`Arduino: ${data}`);
});

app.listen(port, () => {
  console.log(`Server is running at http://localhost:${port}`);
});
