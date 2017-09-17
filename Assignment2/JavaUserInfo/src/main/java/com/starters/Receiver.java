package com.starters;

import java.util.concurrent.CountDownLatch;

import org.apache.log4j.Logger;
import org.springframework.amqp.rabbit.core.RabbitTemplate;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;

import com.rabbitmq.client.Channel;
import com.rabbitmq.client.Connection;
import com.rabbitmq.client.ConnectionFactory;
import com.starters.model.User;
import com.starters.service.AddUserService;

@Component
public class Receiver {

    private CountDownLatch latch = new CountDownLatch(1);
    private final static Logger logger = Logger.getLogger(Receiver.class);
    private static final String SEPARATOR = "-";

    @Autowired
	private AddUserService adduserservice;
    
    private final RabbitTemplate rabbitTemplate;
    
    public Receiver(Receiver receiver, RabbitTemplate rabbitTemplate) {
        this.rabbitTemplate = rabbitTemplate;
    }
    
    public void receiveMessage(byte[] message) {
    	try {
    		String contentString = new String(message);
    		if(contentString.equals("hello")){
    			rabbitTemplate.convertAndSend("java-exchange","api-queue","Hello from Java Micro Service through RabbitMQ");
    		}
    		else{
    			String[] parts = contentString.split(SEPARATOR);
            	User user = new User(parts[0],parts[1],parts[2]);
                String retMessage = adduserservice.save(user);
                logger.info(retMessage);
                latch.countDown();
    		}
    	}
    	catch(Exception ex){
    		ex.printStackTrace();
    	}
    }

    public CountDownLatch getLatch() {
        return latch;
    }
}