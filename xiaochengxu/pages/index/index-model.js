//引入基类
import { Base } from '../../utils/base.js';


class Home extends Base{
  //构造函数
  //constructor(){
  //  super();
  //}

  //向后台获取信息举例
  getUserData(callback){
    var params = {
      url : 'getuser2',
      data : {
        'openid':'helloworld'
      },
      //type : 'POST',
      sCallback : function(res){
        callback && callback(res);
      }
    };
    this.request(params);
    //return callback(params);
  }

  test(){
    console.log('test');
  }



}

export { Home };