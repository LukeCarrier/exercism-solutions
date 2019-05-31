const CALM_DOWN: &str = "Calm down, I know what I'm doing!";
const SURE: &str = "Sure.";
const FINE: &str = "Fine. Be that way!";
const WHOA: &str = "Whoa, chill out!";
const WHATEVER: &str = "Whatever.";

enum MessageType {
    Silence,
    Question,
    Statement,
}

impl MessageType {
    fn new(mut message: &str) -> Self {
        message = message.trim();
        if message.is_empty() {
            MessageType::Silence
        } else if message.ends_with('?') {
            MessageType::Question
        } else {
            MessageType::Statement
        }
    }
}

enum MessageTone {
    Normal,
    Shouted,
}

impl MessageTone {
    fn new(message: &str) -> Self {
        let mut chars = message.chars().filter(|c| c.is_alphabetic()).peekable();
        let letters = chars.peek().is_some();
        let all_upper = chars.all(char::is_uppercase);

        if letters && all_upper {
            MessageTone::Shouted
        } else {
            MessageTone::Normal
        }
    }
}

pub fn reply(message: &str) -> &str {
    let msg_type = MessageType::new(message);
    let msg_tone = MessageTone::new(message);

    match (msg_type, msg_tone) {
        (MessageType::Question, MessageTone::Shouted) => CALM_DOWN,
        (MessageType::Question, _) => SURE,
        (MessageType::Silence, _) => FINE,
        (_, MessageTone::Shouted) => WHOA,
        _ => WHATEVER,
    }
}
