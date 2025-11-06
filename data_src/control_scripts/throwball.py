from pymycobot.mycobot import MyCobot
import time

mc = MyCobot('/dev/ttyAMA0',1000000)
mc.send_angles([(-80),(-35),(-90),20,0,0],50)
time.sleep(1)
mc.set_gripper_value(0,100)
time.sleep(1)
mc.send_angles([0,0,0,0,0,0],50)
time.sleep(1)
mc.send_angles([(-80),(-35),(-90),20,0,0],50)
time.sleep(1)
mc.set_gripper_value(100,100)
