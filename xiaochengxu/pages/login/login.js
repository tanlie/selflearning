import { Base } from '../../util/base.js';
var base = new Base();

Page({
  data: {
    checkboxValue: ['0'],
    checkboxItems: [
      { name: '自动登录', value: '0', checked: true }
    ],
    comfooter:{
      ver_no:'v-1.0.0',
      phone_no:'0760-88888888'
    }
  },
  bindInput: function (e) {
    this.data[e.currentTarget.dataset.name] = e.detail.value;
  },

  checkboxChange: function (e) {
    base.changeCheckBox(this, "checkboxItems", "checkboxValue", e.detail.value);
  },
  onLogin: function (e) {
    base.openLoading("正在登录");
    var user_name = this.data.userName;
    if (!user_name || user_name == ""){
      base.alert("请填写正确的账号");
      return;
    }
    var pass_word = this.data.password;
    if (!pass_word || pass_word == "") {
      base.alert("请填写密码");
      return;
    }
    
    var data = {
      user_name: this.data.userName,
      pass_word: this.data.password
    }
    var params = {
      url: "login",
      data: data,
      method: "post",
      sCallback: function (success, data, error) {
        base.hideLoading();
        if (success) {
          console.log(data);
          var token = "";
          wx.setStorageSync(key, token)
        }
        else {
          base.alert(error.errmsg);
        }
      }
    };
    base.request(params);
  }
})
