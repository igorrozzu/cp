import * as ActionTypes  from "./../actions/action-types";

const initialState = {
    data: [],
    meta: {
        limit: 9,
        page: 1,
        count: 0,
        pageCount: 20
    },
};
const cinemas = (state = initialState, action) => {
    switch (action.type) {
        case ActionTypes.SET_CINEMAS:
            return {
                data: action.payload.data,
                meta: {
                    limit: action.payload.per_page,
                    page: action.payload.current_page,
                    count: action.payload.total,
                    pageCount: action.payload.last_page
                },
            };
        default:
            return state;
    }
};

export default cinemas;
