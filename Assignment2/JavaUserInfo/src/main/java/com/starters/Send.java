package com.starters;

import java.util.concurrent.TimeUnit;
import org.springframework.amqp.rabbit.core.RabbitTemplate;
import org.springframework.boot.CommandLineRunner;
import org.springframework.stereotype.Component;

@Component
public class Send implements CommandLineRunner{
	
	private final RabbitTemplate rabbitTemplate;
	private final Receiver receiver;
    
    public Send(Receiver receiver, RabbitTemplate rabbitTemplate) {
        this.receiver = receiver;
        this.rabbitTemplate = rabbitTemplate;
    }

	@Override
	public void run(String... args) throws Exception {
		System.out.println("Sending message...");
        rabbitTemplate.convertAndSend(JavaCalculatorApplication.myQueue, "Hello from RabbitMQ");
        receiver.getLatch().await(10000, TimeUnit.MILLISECONDS);
	}
}
