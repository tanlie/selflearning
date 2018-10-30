from flask import request

from app.libs.enums import ClientTypeEnums
from app.libs.redprint import Redprint
from app.validators.forms import ClientForm

api = Redprint('client')

@api.route('/register', methods=['POST'])
def create_client():
    #注册 登录 接收方式=>表单和json
    #参数 接收 校验 request.json request.args.to_dict()
    data = request.json
    form = ClientForm(data=data)
    if form.validate():
        promise = {
            ClientTypeEnums.USER_EMAIL : __register_user_by_email,
            ClientTypeEnums.USER_MINA : __register_user_by_mina
        }
    pass



#通过email注册用户
def __register_user_by_email():
    pass

#通过 小程序登录用户
def __register_user_by_mina():
    pass