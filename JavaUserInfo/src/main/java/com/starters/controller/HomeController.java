package com.starters.controller;

import java.util.List;
import com.starters.service.UrlConnector;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import com.starters.model.User;
import com.starters.service.AddUserService;


@CrossOrigin()
@RestController
public class HomeController {

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
		adduserservice.save(user);
		return "User SAVED!";
	}
	
	
}
