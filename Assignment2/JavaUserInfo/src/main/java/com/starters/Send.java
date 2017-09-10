package com.starters;

import org.springframework.amqp.rabbit.core.RabbitTemplate;
import org.springframework.boot.CommandLineRunner;
import org.springframework.stereotype.Component;

@Component
public class Send implements CommandLineRunner{
	
	private final RabbitTemplate rabbitTemplate;
    
    public Send(Receiver receiver, RabbitTemplate rabbitTemplate) {
        this.rabbitTemplate = rabbitTemplate;
    }

	@Override
	public void run(String... args) throws Exception {
		System.out.println("Sending message...");
        rabbitTemplate.convertAndSend("java-exchange","python-queue", "Hello from RabbitMQ");
	}
}

