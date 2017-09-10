#!flask/bin/python
import requests
import pika
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

@app.route('/postUserThroughRabbit')
def post_user_through_rabbit():
    connection = pika.BlockingConnection(pika.ConnectionParameters('localhost'))
    channel = connection.channel()
    channel.queue_declare(queue='java-queue')
    channel.basic_publish(exchange='java-exchange',
                      routing_key='java',
                      body='python-python@iu.edu-8128558585')
    connection.close()
    return "SENT INFO THROUGH RABBITMQ"



if __name__ == '__main__':
    app.run(debug=True)