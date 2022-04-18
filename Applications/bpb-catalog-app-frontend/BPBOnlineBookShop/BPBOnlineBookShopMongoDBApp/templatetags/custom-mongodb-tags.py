from django import template

register = template.Library()

@register.filter(name='bpbfrontendapp')
def bpbfrontendapp(obj, attribute):
    return obj[attribute]