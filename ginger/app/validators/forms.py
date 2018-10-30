
from wtforms import Form, StringField, IntegerField
from wtforms.validators import DataRequired, length

from app.libs.enums import ClientTypeEnums


class ClientForm(Form):
    account = StringField(validators=[DataRequired(), length(
        min=4, max=32
    )])
    password = StringField()
    type = IntegerField(validators=[DataRequired()])


    def validate_type(self, value):
        try:
            client = ClientTypeEnums(value.data)
        except ValueError as e:
            raise e

