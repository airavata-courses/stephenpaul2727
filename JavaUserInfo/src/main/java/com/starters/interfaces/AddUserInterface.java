package com.starters.interfaces;

import org.springframework.data.repository.CrudRepository;

import com.starters.model.User;

public interface AddUserInterface extends CrudRepository<User,Integer>{

}
