'use strict'
const User =use('App/Models/User')
/*const pathAuth =use('App/help/path')
const pathA=new pathAuth()*/
class AuthController {

    async resgister({request}){
        const data=request.only(
            [
                'username','email','password'
            ]
        )

        const user=await User.create(data)
        return user
    }
async authenticate({request,auth})
{
    const {email,password}=request.all()
    const token= await auth.attempt(email,password)

    return request.all()

}
async show({request,response,param})
	{
		return User.find(1)
	}
async test({request,response}){
    //Verificar autrorização do recurso
if(pathA.authUrl(request.originalUrl(),request.method(),"/auth/test")==406)
{return response.sendStatus(200)
   // return response.redirect('back',{code:406})
 }
    else{

    }
}


async sucesso({request,response}){
  //  return response.data}
  return 100

}}

module.exports = AuthController
