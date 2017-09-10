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
    private static final String SEPERATOR = "|";

    @Autowired
	private AddUserService adduserservice;
    
    public void receiveMessage(String message) {
        System.out.println("Received <" + message + ">");
        String[] userInfo = message.split(SEPERATOR);
        if(userInfo[0].equalsIgnoreCase("STORE")){
        	User user = new User(userInfo[1],userInfo[2],userInfo[3]);
            String retMessage = adduserservice.save(user);
            logger.info("SAVE MESSAGE:"+retMessage);
        }
        else {
        	logger.error("MESSAGE CAN'T BE CLASSIFIED");
        }
        
        latch.countDown();
    }

    public CountDownLatch getLatch() {
        return latch;
    }
}