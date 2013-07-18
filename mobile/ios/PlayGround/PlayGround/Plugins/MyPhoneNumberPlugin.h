//
//  MyPhoneNumber.h
//  ImAlive
//
//  Created by Guy Vider on 8/22/11.
//  Copyright 2011 Traveling Tech Guy. All rights reserved.
//

#import <Cordova/CDVPlugin.h>

@interface MyPhoneNumberPlugin : CDVPlugin {
	
}

- (void) getMyPhoneNumber:(CDVInvokedUrlCommand*)command withDict:(NSMutableDictionary*)options;
- (NSString *) MD5Hash:(NSString*)data;
@end
