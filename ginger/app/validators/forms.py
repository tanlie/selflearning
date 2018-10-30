
from wtforms import Form, StringField, IntegerField
from wtforms.validators import DataRequired, length, Email

from app.libs.enums import ClientTypeEnums


class ClientForm(Form):
    account = StringField(validators=[DataRequired(), length(
        min=4, max=32
    )])
    secret = StringField()
    type = IntegerField(validators=[DataRequired()])


    def validate_type(self, value):
        try:
            client = ClientTypeEnums(value.data)
        except ValueError as e:
            raise e
        self.type.data = client



class UserEmailForm(ClientForm):
    account = StringField(validators=[
        Email(message='invalidate email')
    ])
    secret = StringField(validators=[DataRequired(), length(
        min=6, max=100
    )])
    nickname = StringField(validators=[length(max=100)])