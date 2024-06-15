from flask import Flask, render_template, request
import serial

app = Flask(__name__)

ser = serial.Serial('COM4', 9600, timeout=1)  # Adjust the port and baud rate based on your Arduino configuration

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/send_command', methods=['POST'])
def send_command():
    command = request.form['command']
    ser.write(command.encode())
    return 'OK'

if __name__ == '__main__':
    app.run(debug=True)
