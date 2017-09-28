#!flask/bin/python
import requests
import pika
import sys
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

##*****************************************************************


mycredentials = pika.PlainCredentials('guest', 'guest')
connection = pika.BlockingConnection(pika.ConnectionParameters(host='129.114.104.44',port=5672,credentials=mycredentials))
channel = connection.channel()
channel.exchange_declare(exchange='java-exchange',type='topic',durable='true')
result = channel.queue_declare(exclusive=True)
queue_name = result.method.queue

channel.queue_bind(exchange='java-exchange',
                       queue=queue_name,
                       routing_key='python-queue')

channel.basic_consume(callback,
                      queue=queue_name,
                      no_ack=True)
channel.start_consuming()

def callback(ch, method, properties, body):
        print(body)
        bodyMessage = str(body, "utf-8")
        if bodyMessage=='javauserinfo':
            r = requests.get('http://129.114.104.44:8090/getuserdata')
            print(r.text)  
            ch.queue_declare(queue='api-queue',durable=True)
            ch.basic_publish(exchange='java-exchange',
                              routing_key='api-queue',
                              body=r.text)
        elif bodyMessage=='cars':
            carsstring = ''.join(str(elm) for elm in cars)
            ch.queue_declare(queue='api-queue',durable=True)
            ch.basic_publish(exchange='java-exchange',
                              routing_key='api-queue',
                              body=carsstring)   
        else:
            print(" [x] %r:%r" % (method.routing_key, body))



##*****************************************************************


@app.route('/cars')
def get_tasks():
    return jsonify({'cars': cars})

@app.route('/getjavadata')
def get_data_from_spring_boot():
    r = requests.get('http://129.114.104.44:8090/getuserdata')
    return r.content  

@app.route('/postUserThroughRabbit')
def post_user_through_rabbit():
    mycredentials = pika.PlainCredentials('guest', 'guest')
    connection = pika.BlockingConnection(pika.ConnectionParameters(host='129.114.104.44',port=5672,credentials=mycredentials))
    channel = connection.channel()
    channel.queue_declare(queue='java-queue')
    channel.basic_publish(exchange='java-exchange',
                      routing_key='java',
                      body='python-python@iu.edu-8128558585')
    channel.close()
    connection.close()
    return "SENT INFO THROUGH RABBITMQ"


@app.route('/')
def python_listener():
    mycredentials = pika.PlainCredentials('guest', 'guest')
    connection = pika.BlockingConnection(pika.ConnectionParameters(host='129.114.104.44',port=5672,credentials=mycredentials))
    channel = connection.channel()
    channel.exchange_declare(exchange='java-exchange',type='topic',durable='true')
    result = channel.queue_declare(exclusive=True)
    queue_name = result.method.queue

    channel.queue_bind(exchange='java-exchange',
                           queue=queue_name,
                           routing_key='python-queue')

    print(' Listening for any Messages.......')
    def callback(ch, method, properties, body):
        print(body)
        bodyMessage = str(body, "utf-8")
        if bodyMessage=='javauserinfo':
            r = requests.get('http://129.114.104.44:8090/getuserdata')
            print(r.text)  
            ch.queue_declare(queue='api-queue',durable=True)
            ch.basic_publish(exchange='java-exchange',
                              routing_key='api-queue',
                              body=r.text)
        elif bodyMessage=='cars':
            carsstring = ''.join(str(elm) for elm in cars)
            ch.queue_declare(queue='api-queue',durable=True)
            ch.basic_publish(exchange='java-exchange',
                              routing_key='api-queue',
                              body=carsstring)   
        else:
            print(" [x] %r:%r" % (method.routing_key, body))
        

    channel.basic_consume(callback,
                      queue=queue_name,
                      no_ack=True)
    channel.start_consuming()
    return "MESSAGE RECEIVED! PLEASE CHECK YOUR CONSOLE!"




if __name__ == '__main__':
    app.run(debug=True,host='0.0.0.0')