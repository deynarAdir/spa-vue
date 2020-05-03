// export function login(credentials){
// 	return new Promise( (res,rej) => {
// 		axios({
// 			method:'post',
// 			url: 'api/auth/login',
// 			data: credentials
// 		})
// 		.then(function (response) {
// 			res(response.data);
// 		}).catch(function (error) {
// 			rej("Error al intentar loguearte");
// 		});
// 	});
// }

export function getLocalUser(){
	const userStr = localStorage.getItem("user");
	if(userStr === null){
		return null;
	}
	return JSON.parse(userStr);
}