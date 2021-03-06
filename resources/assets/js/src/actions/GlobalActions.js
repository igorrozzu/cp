import * as ActionTypes  from "./action-types";
import {API_URI as uri} from '../config/AppConstants';
import {errorAction} from "./CommonActions";
import axios from 'axios';
axios.defaults.withCredentials = true;

export function resetState() {

    return {
        type: ActionTypes.RESET_MESSAGE,
        payload: {}
    };
}

export function getEntity(params) {
    return (dispatch) => {
        axios.get(
            `${uri}/${params.entityName}/${params.entityId}`
        ).then(response => {
            dispatch({
                type: ActionTypes.GET_ENTITY,
                payload: response.data
            });
        }).catch(error => {
            dispatch(errorAction(error));
        });
    }
}

/**
 description
 :
 "123412"
 duration
 :
 "123"
 name
 :
 "31231"
 rating
 :
 "12312"
 slogan
 :
 "21312"


 */


export function addEntity(params) {
    return (dispatch) => {
        axios.post(
            `${uri}/${params.entityName}`, params.data
        ).then(data => {
            dispatch({
                type: ActionTypes.SERVER_SUCCESS,
                payload: {message: `Entity has successfully added`}
            });
        }).catch(error => {
            dispatch(errorAction(error));
        });
    }
}

export function updateEntity(params) {
    return (dispatch) => {
        axios.put(
            `${uri}/${params.entityName}/${params.entityId}`, params.data
        ).then(data => {
            dispatch({
                type: ActionTypes.SERVER_SUCCESS,
                payload: {message: `Entity has successfully updated`}
            });
        }).catch(error => {
            dispatch(errorAction(error));
        });
    }
}

