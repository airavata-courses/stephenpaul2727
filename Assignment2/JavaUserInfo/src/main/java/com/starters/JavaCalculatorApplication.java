package com.starters;

import org.springframework.amqp.core.Binding;
import org.springframework.amqp.core.BindingBuilder;
import org.springframework.amqp.core.Queue;
import org.springframework.amqp.core.TopicExchange;
import org.springframework.amqp.rabbit.connection.ConnectionFactory;
import org.springframework.amqp.rabbit.listener.SimpleMessageListenerContainer;
import org.springframework.amqp.rabbit.listener.adapter.MessageListenerAdapter;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.annotation.Bean;


@SpringBootApplication
public class JavaCalculatorApplication {
	
	final static String myQueue = "java-queue";
	
	@Bean
	Queue queue() {
		return new Queue(myQueue,false);
	}
	
	@Bean
	TopicExchange exchange() {
		return new TopicExchange("java-exchange");
	}
	
	@Bean
	Binding binding(Queue queue, TopicExchange topic){
		return BindingBuilder.bind(queue).to(topic).with(myQueue);
	}
	
	@Bean
	SimpleMessageListenerContainer container(ConnectionFactory connectionFactory,MessageListenerAdapter listenerAdapter){
		SimpleMessageListenerContainer container = new SimpleMessageListenerContainer();
		container.setConnectionFactory(connectionFactory);
		container.setQueueNames(myQueue);
		container.setMessageListener(listenerAdapter);
		return container;
	}
	
	@Bean
	MessageListenerAdapter listener(Receiver receiver){
		return new MessageListenerAdapter(receiver, "receiveMessage");
	}
	public static void main(String[] args) {
		SpringApplication.run(JavaCalculatorApplication.class, args);
	}
}
