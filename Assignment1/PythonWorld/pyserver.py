#!flask/bin/python
import requests
from flask import Flask, jsonify
from flask_cors import CORS, cross_origin


app = Flask(__name__)
CORS(app)

cars = [
    {
        'manufacturer': 'Porsche',
        'model': '911',
        'price': 135000,
        'wiki': 'http://en.wikipedia.org/wiki/Porsche_997',
    },
    {
        'manufacturer': 'Nissan',
        'model': 'GT-R',
        'price': 80000,
        'wiki': 'http://en.wikipedia.org/wiki/Nissan_Gt-r',
    }
]

@app.route('/')
def index():
    return "Welcome to the Python Microservice"

@app.route('/cars')
def get_tasks():
    return jsonify({'cars': cars})

@app.route('/getjavadata')
def get_data_from_spring_boot():
    r = requests.get('http://localhost:8080/getuserdata')
    return r.content    

if __name__ == '__main__':
    app.run(debug=True)