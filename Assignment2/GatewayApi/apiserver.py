#!flask/bin/python
import requests
import pika
from flask import Flask, jsonify, redirect
from flask_cors import CORS, cross_origin

app = Flask(__name__)
app.config['SERVER_NAME']='0.0.0.0:2500'
CORS(app)

@app.route('/')
def main():
  return "Connected to API SERVER!"

@app.route('/laraveltime')
def laraveltime():
  mycredentials = pika.PlainCredentials('guest', 'guest')
  connection = pika.BlockingConnection(pika.ConnectionParameters(host='rabbit-server',port=5672,credentials=mycredentials))
  channel = connection.channel()
  channel.queue_declare(queue='php-queue',durable=True, exclusive=False, auto_delete=False)
  channel.basic_publish(exchange='java-exchange',
                    routing_key='php-queue',
                    body='time')
  channel.close()
  connection.close()
  return "requested time from laravel! Check your endpoint outputmsg to receive msg"

@app.route('/javahome')
def javahome():
  return redirect('http://localhost:8080/')

@app.route('/laraveluserinfo')
def laraveluserinfo():
  return redirect('http://localhost:8000/getuserinfo')

@app.route('/javahello')
def javahello():
  return redirect('http://localhost:8080/hello') 

@app.route('/flaskuserinfo')
def flaskuserinfo():
  return redirect('http://localhost:5000/getjavadata') 

@app.route('/flaskcars')
def flaskcars():
  return redirect('http://localhost:5000/cars')  

@app.route('/outputmsg')
def outputmsg():
  print(' Listening for any Messages.......')
  mycredentials = pika.PlainCredentials('guest', 'guest')
  connection = pika.BlockingConnection(pika.ConnectionParameters(host='rabbit-server',port=5672,credentials=mycredentials))
  channel = connection.channel()
  channel.exchange_declare(exchange='java-exchange',type='topic',durable='true')
  channel.queue_declare(queue='api-queue',durable=True, exclusive=False, auto_delete=False)

  result = channel.queue_declare(exclusive=True)
  queue_name = result.method.queue

  channel.queue_bind(exchange='java-exchange',
                         queue=queue_name,
                         routing_key='api-queue')

  print(' Listening for any Messages.......')
  def callback(ch, method, properties, body):
      print(" [x] %r:%r" % (method.routing_key, body))
      ch.close()
  channel.basic_consume(callback,
                    queue=queue_name,
                    no_ack=True)
  channel.start_consuming()
  return "MESSAGE RECEIVED! PLEASE CHECK YOUR CONSOLE!"

         

if __name__ == '__main__':
  app.run(debug=True,host='0.0.0.0')