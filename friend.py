from chatterbot import ChatBot
from chatterbot.trainers import ListTrainer

bot = ChatBot('bot')
bot = ChatBot('bot', storage_adapter='chatterbot.storage.SQLStorageAdapter', 
                     database_uri='sqlite:///database.sqlite1')

print('Type something to begin...')

while True:
    try:
        user_input = input()
        bot_response = str(bot.get_response(user_input))
        #bot_response1 = str(bot.get_response(user_input))
        print("user : " + user_input)
        print("bot : " + bot_response )

    except (KeyboardInterrupt, EOFError, SystemExit):
        break

