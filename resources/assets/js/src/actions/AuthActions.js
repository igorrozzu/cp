import * as ActionTypes  from "./action-types";
import Cookies from 'universal-cookie';
import * as constants from '../config/AppConstants';
import {errorAction} from './CommonActions';
import {roles} from "../config/UserConstants";
import axios from 'axios';
axios.defaults.withCredentials = true;

export function login(data) {
    return (dispatch) => {
        axios.post(
             `${constants.URI}/auth/login`, {
                email: data.email,
                password: data.password
            }
        ).then(response => {
            console.log(response.data);
            const cookies = new Cookies();
            cookies.set('token', response.data.token, {
                path: '/' ,
                expires: new Date(Date.now() + 30 * 60 * 1000),
            });
            dispatch({
                type: ActionTypes.LOGIN_USER,
                payload: response.data.user
            });
            dispatch({
                type: ActionTypes.SERVER_SUCCESS,
                payload: {message: `You has successfully logged in`}
            });
        }).catch(error => {
            dispatch(errorAction(error));
        });
    }
}

export function initUser() {
    return (dispatch) => {
        axios.post(`${constants.URI}/auth/check-login`)
            .then(response => {
            dispatch({
                type: ActionTypes.LOGIN_USER,
                payload: response.data
            });
        }).catch(error => {});
    }
}


export function logout() {
    return (dispatch) => {
        const cookies = new Cookies();
        cookies.remove('token');
        dispatch({
            type: ActionTypes.LOGOUT_USER,
            payload: {isGuest: true, data: {role: roles.GUEST}}
        });
        dispatch({
            type: ActionTypes.SERVER_SUCCESS,
            payload: {message: `You've successfully logged out`}
        });
    }
}