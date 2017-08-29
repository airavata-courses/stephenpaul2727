package com.starters.controller;

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
	
	@GetMapping("/getuserdata")
	public String allUsers()
	{
		return adduserservice.findAll().toString();
	}
	
	@GetMapping("/saveuserdata")
	public String saveUser(@RequestParam String name,@RequestParam String email,@RequestParam String phone)
	{
		User user = new User(name,email,phone);
		adduserservice.save(user);
		return "User SAVED!";
	}
}
