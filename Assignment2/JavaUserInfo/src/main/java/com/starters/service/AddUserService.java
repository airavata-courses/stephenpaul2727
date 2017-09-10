package com.starters.service;

import java.util.ArrayList;
import java.util.List;

import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import com.starters.interfaces.AddUserInterface;
import com.starters.model.User;


@Service
@Transactional
public class AddUserService{
	
	private final AddUserInterface adduserinterface;
	
	public AddUserService(AddUserInterface adduserinterface)
	{
		this.adduserinterface = adduserinterface;
	}
	
	public List<User> findAll()
	{
		List<User> users = new ArrayList<>();
		for(User user:adduserinterface.findAll())
		{
			users.add(user);
		}
		return users;
	}
	
	public String save(User user)
	{
		for(User dbusers:adduserinterface.findAll()){
			if(dbusers.getName().equalsIgnoreCase(user.getName()) || dbusers.getEmail().equalsIgnoreCase(user.getEmail()) || dbusers.getPhone().equalsIgnoreCase(user.getPhone())){
				return "USER EXISTS";
			}
		}
		adduserinterface.save(user);
		return "SAVED";
	}
	
	public void delete(int id)
	{
		adduserinterface.delete(id);
	}

}
