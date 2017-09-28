var express = require('express');

var cors = require('cors');

var amqp = require('amqplib/callback_api');

var app = express();

app.use(cors())



app.get('/',function(req,res){
	res.send("Connected to the NODE API Gateway!");
});

//getting the time from laravel microservice through RabbitMq.
app.get('/laraveltime',function(req,res){
	amqp.connect('amqp://129.114.104.44', function(err, conn) {
		conn.createChannel(function(err, ch) {
		  var exchange = 'java-exchange';
	    var key = 'php-queue';
	    var msg = 'time';

	    ch.assertExchange(exchange, 'topic', {durable: true});
	    ch.publish(exchange, key, Buffer.from(msg));
	    console.log(" [x] Sent %s:'%s'", key, msg);

	    ch.assertQueue('api-queue', {exclusive: false}, function(err, q) {
	      console.log(' [*] Waiting for logs. To exit press CTRL+C');
	      ch.bindQueue(q.queue, exchange, 'api-queue');

	      ch.consume(q.queue, function(msg) {
	        console.log(" [x] %s:'%s'", msg.fields.routingKey, msg.content.toString());
					res.writeHead(200,{'Content-Type': 'text/plain'});
	        res.write(msg.content.toString());
	      }, {noAck: true});
	    });
	  });
	});
});

//getting the javauserinfo from java microservice and laravel microservice through RabbitMq
app.get('/laraveluserinfo',function(req,res){
	amqp.connect('amqp://129.114.104.44', function(err, conn) {
		conn.createChannel(function(err, ch) {
		  var exchange = 'java-exchange';
	    var key = 'php-queue';
	    var msg = 'userinfo';

	    ch.assertExchange(exchange, 'topic', {durable: true});
	    ch.publish(exchange, key, Buffer.from(msg));
	    console.log(" [x] Sent %s:'%s'", key, msg);

	    ch.assertQueue('api-queue', {exclusive: false}, function(err, q) {
	      console.log(' [*] Waiting for logs. To exit press CTRL+C');
	      ch.bindQueue(q.queue, exchange, 'api-queue');

	      ch.consume(q.queue, function(msg) {
	        console.log(" [x] %s:'%s'", msg.fields.routingKey, msg.content.toString());
					res.writeHead(200,{'Content-Type': 'text/plain'});      
	        res.write(msg.content.toString());
	      }, {noAck: true});
	    });
	  });
	});
});

//getting the hello message from java microservice.
app.get('/javahello',function(req,res){
	amqp.connect('amqp://129.114.104.44', function(err, conn) {
		conn.createChannel(function(err, ch) {
		  var exchange = 'java-exchange';
	    var key = 'java';
	    var msg = 'hello';

	    ch.assertExchange(exchange, 'topic', {durable: true});
	    ch.publish(exchange, key, Buffer.from(msg));
	    console.log(" [x] Sent %s:'%s'", key, msg);

	    ch.assertQueue('api-queue', {exclusive: false}, function(err, q) {
	      console.log(' [*] Waiting for logs. To exit press CTRL+C');
	      ch.bindQueue(q.queue, exchange, 'api-queue');

	      ch.consume(q.queue, function(msg) {
	        console.log(" [x] %s:'%s'", msg.fields.routingKey, msg.content.toString());
					res.writeHead(200,{'Content-Type': 'text/plain'});
	        res.write(msg.content.toString());
	      }, {noAck: true});
	    });
	  });
	});
});

//getting the java userinfo from python flask microservice through rabbitmq.
app.get('/pythonuserinfo',function(req,res){
	amqp.connect('amqp://129.114.104.44', function(err, conn) {
		conn.createChannel(function(err, ch) {
		  var exchange = 'java-exchange';
	    var key = 'python-queue';
	    var msg = 'javauserinfo';

	    ch.assertExchange(exchange, 'topic', {durable: true});
	    ch.publish(exchange, key, Buffer.from(msg));
	    console.log(" [x] Sent %s:'%s'", key, msg);

	    ch.assertQueue('api-queue', {exclusive: false,durable: true}, function(err, q) {
	      console.log(' [*] Waiting for logs. To exit press CTRL+C');
	      ch.bindQueue(q.queue, exchange, 'api-queue');

	      ch.consume(q.queue, function(msg) {
	        console.log(" [x] %s:'%s'", msg.fields.routingKey, msg.content.toString());
					res.writeHead(200,{'Content-Type': 'text/plain'});
	        res.write(msg.content.toString());
	      }, {noAck: true});
	    });
	  });
	});
});

//getting the java userinfo from python flask microservice through rabbitmq.
app.get('/pythoncars',function(req,res){
	amqp.connect('amqp://129.114.104.44', function(err, conn) {
		conn.createChannel(function(err, ch) {
		  var exchange = 'java-exchange';
	    var key = 'python-queue';
	    var msg = 'cars';

	    ch.assertExchange(exchange, 'topic', {durable: true});
	    ch.publish(exchange, key, Buffer.from(msg));
	    console.log(" [x] Sent %s:'%s'", key, msg);

	    ch.assertQueue('api-queue', {exclusive: false,durable: true}, function(err, q) {
	      console.log(' [*] Waiting for logs. To exit press CTRL+C');
	      ch.bindQueue(q.queue, exchange, 'api-queue');

	      ch.consume(q.queue, function(msg) {
	        console.log(" [x] %s:'%s'", msg.fields.routingKey, msg.content.toString());
					res.writeHead(200,{'Content-Type': 'text/plain'});
	        res.write(msg.content.toString());
	      }, {noAck: true});
	    });
	  });
	});
});


app.listen(3000,function(){
	console.log("listening on port 3000");
});
