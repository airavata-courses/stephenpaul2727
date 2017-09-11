#!flask/bin/python
import requests
from flask import Flask, jsonify, redirect
from flask_cors import CORS, cross_origin

app = Flask(__name__)
CORS(app)

@app.route('/laraveltime')
def laraveltime():
    return redirect('http://localhost:8000/time')

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

if __name__ == '__main__':
    app.run(host='127.0.0.1',port='2500')