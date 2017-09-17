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
    r = requests.get('http://java-server:8080/getuserdata')
    return r.content  

@app.route('/postUserThroughRabbit')
def post_user_through_rabbit():
    mycredentials = pika.PlainCredentials('guest', 'guest')
    connection = pika.BlockingConnection(pika.ConnectionParameters(host='rabbit-server',port=5672,credentials=mycredentials))
    channel = connection.channel()
    channel.queue_declare(queue='java-queue')
    channel.basic_publish(exchange='java-exchange',
                      routing_key='java',
                      body='python-python@iu.edu-8128558585')
    connection.close()
    return "SENT INFO THROUGH RABBITMQ"


@app.route('/PythonListener')
def python_listener():
    mycredentials = pika.PlainCredentials('guest', 'guest')
    connection = pika.BlockingConnection(pika.ConnectionParameters(host='rabbit-server',port=5672,credentials=mycredentials))
    channel = connection.channel()
    channel.exchange_declare(exchange='java-exchange',type='topic',durable='true')
    channel.queue_declare(queue='python-queue',durable=True, exclusive=False, auto_delete=False)

    result = channel.queue_declare(exclusive=True)
    queue_name = result.method.queue

    channel.queue_bind(exchange='java-exchange',
                           queue=queue_name,
                           routing_key='python-queue')

    print(' Listening for any Messages.......')
    def callback(ch, method, properties, body):
        if body == 'javauserinfo':
            print("inside callback")
            ch.close()
            r = requests.get('http://java-server:8080/getuserdata')
            mycredentials = pika.PlainCredentials('guest', 'guest')
            connection = pika.BlockingConnection(pika.ConnectionParameters(host='rabbit-server',port=5672,credentials=mycredentials))
            channel = connection.channel()
            channel.queue_declare(queue='api-queue')
            channel.basic_publish(exchange='java-exchange',
                              routing_key='api-queue',
                              body=r.content)
            channel.close()
            connection.close()
        else:
            print(" [x] %r:%r" % (method.routing_key, body))
            ch.close()
    channel.basic_consume(callback,
                      queue=queue_name,
                      no_ack=True)
    channel.start_consuming()
    return "MESSAGE RECEIVED! PLEASE CHECK YOUR CONSOLE!"




if __name__ == '__main__':
    app.run(debug=True,host='0.0.0.0')