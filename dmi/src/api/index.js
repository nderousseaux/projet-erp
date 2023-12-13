import ApiMed from "./med";
import ApiLogin from "./login";

const ApiFunctions = {
	med : {
		...ApiMed
	},
	login : {
		...ApiLogin
	}

}

export default ApiFunctions;