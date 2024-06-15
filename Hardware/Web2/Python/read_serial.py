from flask import Flask, render_template
from flask_socketio import SocketIO
import serial

app = Flask(__name__)
socketio = SocketIO(app)
ser = serial.Serial('COM4', 9600, timeout=1)  # Replace with the correct COM port

@app.route('/')
def index():
    return render_template('index.html')

@socketio.on('control_led')
def control_led(data):
    command = data['command']
    ser.write(command.encode())

if __name__ == '__main__':
    socketio.run(app, debug=True)
