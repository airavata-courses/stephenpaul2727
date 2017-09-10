package com.starters.controller;

import java.util.List;
import java.util.concurrent.CountDownLatch;

import com.starters.service.UrlConnector;

import org.apache.log4j.Logger;
import org.springframework.amqp.rabbit.core.RabbitTemplate;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import com.starters.model.User;
import com.starters.service.AddUserService;


@CrossOrigin()
@RestController
public class HomeController {
	
	final static Logger logger = Logger.getLogger(HomeController.class);
	
	private CountDownLatch latch = new CountDownLatch(1);
	
	private RabbitTemplate rabbitTemplate;
	
	@Autowired
	public HomeController(RabbitTemplate rabbitTemplate){
		this.rabbitTemplate = rabbitTemplate;
	}
	
	public CountDownLatch getLatch() {
        return latch;
    }

	@Autowired
	private AddUserService adduserservice;
	
	@GetMapping("/")
	public String Hello()
	{
		return "Welcome! This is the JAVA based user adding and retrieving microservice";
	}
	
	@GetMapping("/hello")
	public String Home()
	{
		return "Hello there!";
	}
	
	@GetMapping("/timefromlatavel")
	public String getTimeLaravel(){
		UrlConnector urlconn = new UrlConnector();
		String result = urlconn.getUrlContents("http://localhost:8000/time");
		return result;
	}
	
	@RequestMapping(value="/getuserdata",method=RequestMethod.GET,produces="application/json")
	public List<User> allUsers()
	{
		return adduserservice.findAll();
	}
	
	@GetMapping("/saveuserdata")
	public String saveUser(@RequestParam String name,@RequestParam String email,@RequestParam String phone)
	{
		User user = new User(name,email,phone);
		logger.info("THIS IS EMAIL"+email);
		logger.info("THIS IS PHONE"+phone);
		logger.info("THIS IS NAME:"+name);
		String retMessage = adduserservice.save(user);
		return retMessage;
	}	
	
	@GetMapping("/fanoutjavauserdata")
	public String fanout(){
		List<User> myUserList = adduserservice.findAll();
		rabbitTemplate.convertAndSend("java-exchange","python-queue", myUserList.toString());
		rabbitTemplate.convertAndSend("java-exchange","php-queue", myUserList.toString());
		return "SENT INFO TO RESPECTIVE RECEIVERS";
	}
}
