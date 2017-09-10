package com.starters;

import java.util.concurrent.CountDownLatch;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;
import com.starters.model.User;
import com.starters.service.AddUserService;

@Component
public class Receiver {

    private CountDownLatch latch = new CountDownLatch(1);
    private final static Logger logger = Logger.getLogger(Receiver.class);
    private static final String SEPARATOR = "-";

    @Autowired
	private AddUserService adduserservice;
    
    public void receiveMessage(String message) {
        System.out.println("Received <" + message + ">"); 
        String[] messageActual = message.split("\"");
        String contentString = messageActual[1].toString();
        String[] parts = contentString.split(SEPARATOR);
    	User user = new User(parts[0],parts[1],parts[2]);
        String retMessage = adduserservice.save(user);
        
        latch.countDown();
    }

    public CountDownLatch getLatch() {
        return latch;
    }

//	@Override
//	public void onMessage(Message arg0) {
//		try {
//			Jackson2JsonMessageConverter jmc = new Jackson2JsonMessageConverter();
//			String myResult = jmc.fromMessage(arg0).toString();
//			System.out.println("I REceived: "+myResult);
//			
//		}
//		catch(Exception ex){
//			ex.printStackTrace();
//		}		
//	}
}