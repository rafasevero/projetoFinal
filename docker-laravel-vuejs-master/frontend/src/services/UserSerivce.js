// services/UserService.js
import axios from 'axios';
import HttpService from './HttpService';

const UserService = {
  getUserProfile(userId) {
    return axios.get(`/api/users/${userId}`);
  }
};

export default UserService;
