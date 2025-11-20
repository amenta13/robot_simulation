from pymycobot.mycobot import MyCobot
import time
//Braden Scott commit on hunter robot github
mc = MyCobot('/dev/ttyAMA0',1000000)
mc.send_angles([(-90),0,0,0,0,0],90)
time.sleep(1)
mc.send_angles([(-90),0,(-120),0,0,(-50)],90)
time.sleep(1)
mc.set_gripper_value(0,100)
time.sleep(1)
mc.send_angles([(-85),(-27),(-95),30,0,(-50)],90)
time.sleep(1)
mc.set_gripper_value(100,100)
